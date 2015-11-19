unit Unit1;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, IniFiles, StdCtrls, ComCtrls, ExtCtrls, Menus, Buttons,
  IdBaseComponent, IdComponent, IdTCPConnection, IdTCPClient, IdHTTP,
  ExtCtrlsX, AppEvnts, IdRawBase, IdRawClient, IdIcmpClient,adCpuUsage;

type
  TForm1 = class(TForm)
    Edit1: TEdit;
    Timer1: TTimer;
    IdHTTP1: TIdHTTP;
    Button1: TButton;
    Label1: TLabel;
    TrayIcon1: TTrayIcon;
    ApplicationEvents1: TApplicationEvents;
    Label2: TLabel;
    Edit2: TEdit;
    Memo1: TMemo;
    Bevel1: TBevel;
    Label3: TLabel;
    Label4: TLabel;
    Edit3: TEdit;
    Label5: TLabel;
    procedure FormCreate(Sender: TObject);
    procedure FormDestroy(Sender: TObject);
    procedure Timer1Timer(Sender: TObject);
    procedure Button1Click(Sender: TObject);
    procedure ApplicationEvents1Minimize(Sender: TObject);
    procedure TrayIcon1DblClick(Sender: TObject);


  

  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form1: TForm1;
  LBFontStyle: integer;

implementation

{$R *.dfm}

procedure TForm1.FormCreate(Sender: TObject);
var
 Ini: Tinifile;
 List: TStringList;
 i: integer;
begin
 // Открываем файл
 // Размер и позиция формы
 Ini:=TiniFile.Create(ExtractFilePath(paramstr(0))+'adatum.ini');

 Edit1.Text:= Ini.ReadString('Setting','ServerIp',Edit1.Text);
 Edit2.Text:= Ini.ReadString('Setting','ServerMac',Edit2.Text);
 Edit3.Text:= Ini.ReadString('Setting','ServerTime',Edit3.Text);
 Timer1.Interval:= StrToInt(Ini.ReadString('Setting','ServerTime',Edit3.Text))*60000;



 Ini.Free;

end;


procedure TForm1.FormDestroy(Sender: TObject);
var
 Ini: Tinifile; // необходимо создать объект, чтоб потом с ним работать
 i: integer;
begin
 // Создали файл в директории программы
 Ini:=TiniFile.Create(ExtractFilePath(paramstr(0))+'adatum.ini');
 Ini.WriteString('Setting','ServerIp',Edit1.Text);
 Ini.WriteString('Setting','ServerMac',Edit2.Text);
 Ini.WriteString('Setting','ServerTime',Edit3.Text);

 Ini.Free;
end;







procedure TForm1.Timer1Timer(Sender: TObject);
var
 i: integer;
 cpustr: string;
 allstr: string;
begin
  CollectCPUData;
 for i:=0 to GetCPUCount-1 do



  begin
  if (Round(GetCPUUsage(i)*100)<100) then
begin
    cpustr:=FloatToStr(Round(GetCPUUsage(i)*100));
end
else
begin
cpustr:='0';
end;



 end;

   allstr:='http://'+Edit1.Text+'/post.php?ID='+Edit2.Text+'&CPU='+cpustr;

idhttp1.Get(allstr);
Memo1.Lines.Add(allstr);
end;

procedure TForm1.Button1Click(Sender: TObject);
var
 Ini: Tinifile; // необходимо создать объект, чтоб потом с ним работать
 i: integer;
begin
 // Создали файл в директории программы
 Ini:=TiniFile.Create(ExtractFilePath(paramstr(0))+'adatum.ini');
 Ini.WriteString('Setting','ServerIp',Edit1.Text);
 Ini.WriteString('Setting','ServerMac',Edit2.Text);
  Ini.WriteString('Setting','ServerTime',Edit3.Text);
 Ini.Free;
end;


procedure TForm1.ApplicationEvents1Minimize(Sender: TObject);
begin
TrayIcon1.visible:=true;
//Убираем с панели задач
 ShowWindow(Handle,SW_HIDE);  // Скрываем программу
   ShowWindow(Application.Handle,SW_HIDE);  // Скрываем кнопку с TaskBar'а
SetWindowLong(Application.Handle, GWL_EXSTYLE,
GetWindowLong(Application.Handle, GWL_EXSTYLE) or (not WS_EX_APPWINDOW));
end;



procedure TForm1.TrayIcon1DblClick(Sender: TObject);
begin
TrayIcon1.ShowBalloonHint;
ShowWindow(Handle,SW_RESTORE);
SetForegroundWindow(Handle);
TrayIcon1.Visible:=False;
end;











end.


