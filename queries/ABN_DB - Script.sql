USE [master]
GO
/****** Object:  Database [ABN_DB]    Script Date: 27/12/2020 9:08:15 pm ******/
CREATE DATABASE [ABN_DB]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'ABN_DB', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER01\MSSQL\DATA\ABN_DB.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'ABN_DB_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER01\MSSQL\DATA\ABN_DB_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT
GO
ALTER DATABASE [ABN_DB] SET COMPATIBILITY_LEVEL = 150
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [ABN_DB].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [ABN_DB] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [ABN_DB] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [ABN_DB] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [ABN_DB] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [ABN_DB] SET ARITHABORT OFF 
GO
ALTER DATABASE [ABN_DB] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [ABN_DB] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [ABN_DB] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [ABN_DB] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [ABN_DB] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [ABN_DB] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [ABN_DB] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [ABN_DB] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [ABN_DB] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [ABN_DB] SET  ENABLE_BROKER 
GO
ALTER DATABASE [ABN_DB] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [ABN_DB] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [ABN_DB] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [ABN_DB] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [ABN_DB] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [ABN_DB] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [ABN_DB] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [ABN_DB] SET RECOVERY FULL 
GO
ALTER DATABASE [ABN_DB] SET  MULTI_USER 
GO
ALTER DATABASE [ABN_DB] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [ABN_DB] SET DB_CHAINING OFF 
GO
ALTER DATABASE [ABN_DB] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [ABN_DB] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [ABN_DB] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [ABN_DB] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
EXEC sys.sp_db_vardecimal_storage_format N'ABN_DB', N'ON'
GO
ALTER DATABASE [ABN_DB] SET QUERY_STORE = OFF
GO
USE [ABN_DB]
GO
/****** Object:  Table [dbo].[Applications]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Applications](
	[applicationID] [int] IDENTITY(1,1) NOT NULL,
	[jobPostID] [int] NOT NULL,
	[jobseekerID] [int] NOT NULL,
	[dateApplied] [datetime] NOT NULL,
	[status] [varchar](max) NOT NULL,
 CONSTRAINT [PK_applicationID@Applications] PRIMARY KEY CLUSTERED 
(
	[applicationID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Bookmarks]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Bookmarks](
	[bookmarkID] [int] IDENTITY(1,1) NOT NULL,
	[jobseekerID] [int] NOT NULL,
	[jobPostID] [int] NOT NULL,
	[dateBookmarked] [datetime] NOT NULL,
 CONSTRAINT [PK_bookmarkID@Bookmarks] PRIMARY KEY CLUSTERED 
(
	[bookmarkID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Employers]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Employers](
	[employerID] [int] IDENTITY(1,1) NOT NULL,
	[companyName] [varchar](max) NOT NULL,
	[street] [varchar](max) NOT NULL,
	[brgyDistrict] [varchar](max) NOT NULL,
	[cityMunicipality] [varchar](max) NOT NULL,
	[contactNumber] [varchar](max) NOT NULL,
	[email] [varchar](450) NOT NULL,
	[website] [varchar](max) NULL,
	[description] [varchar](max) NOT NULL,
	[profilePic] [varchar](max) NULL,
 CONSTRAINT [PK_employerID@Employers] PRIMARY KEY CLUSTERED 
(
	[employerID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[JobPosts]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[JobPosts](
	[jobPostID] [int] IDENTITY(1,1) NOT NULL,
	[employerID] [int] NOT NULL,
	[jobTitle] [varchar](max) NOT NULL,
	[jobType] [varchar](max) NOT NULL,
	[industryType] [varchar](max) NOT NULL,
	[description] [varchar](max) NOT NULL,
	[responsibilities] [varchar](max) NOT NULL,
	[skills] [varchar](max) NOT NULL,
	[experiences] [varchar](max) NOT NULL,
	[education] [varchar](max) NOT NULL,
	[minSalary] [money] NOT NULL,
	[maxSalary] [money] NOT NULL,
	[dateCreated] [datetime] NOT NULL,
	[dateModified] [datetime] NULL,
	[jobPostFlag] [binary](1) NOT NULL,
 CONSTRAINT [PK_jobPostID@JobPosts] PRIMARY KEY CLUSTERED 
(
	[jobPostID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[JobSeekers]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[JobSeekers](
	[jobseekerID] [int] IDENTITY(1,1) NOT NULL,
	[firstName] [varchar](max) NOT NULL,
	[middleName] [varchar](max) NULL,
	[lastName] [varchar](max) NOT NULL,
	[birthDate] [date] NOT NULL,
	[gender] [varchar](max) NOT NULL,
	[street] [varchar](max) NOT NULL,
	[brgyDistrict] [varchar](max) NOT NULL,
	[cityMunicipality] [varchar](max) NOT NULL,
	[contactNumber] [varchar](max) NOT NULL,
	[email] [varchar](450) NOT NULL,
	[description] [varchar](max) NOT NULL,
	[skills] [varchar](max) NOT NULL,
	[experiences] [varchar](max) NOT NULL,
	[education] [varchar](max) NOT NULL,
	[profilePic] [varchar](max) NULL,
 CONSTRAINT [PK_jobseekerID@JobSeekers] PRIMARY KEY CLUSTERED 
(
	[jobseekerID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Notifications]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Notifications](
	[notificationID] [int] IDENTITY(1,1) NOT NULL,
	[title] [varchar](max) NOT NULL,
	[message] [varchar](max) NOT NULL,
	[senderID] [int] NOT NULL,
	[receiverID] [int] NOT NULL,
	[readFlag] [binary](1) NOT NULL,
 CONSTRAINT [PK_notificationID@Notifications] PRIMARY KEY CLUSTERED 
(
	[notificationID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[UserAccounts]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UserAccounts](
	[userID] [int] IDENTITY(1,1) NOT NULL,
	[email] [varchar](450) NOT NULL,
	[password] [varchar](max) NOT NULL,
	[userType] [varchar](max) NOT NULL,
	[accountFlag] [binary](1) NOT NULL,
 CONSTRAINT [PK_userID@UserAccounts] PRIMARY KEY CLUSTERED 
(
	[userID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY],
 CONSTRAINT [UQ_email@UserAccounts] UNIQUE NONCLUSTERED 
(
	[email] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
ALTER TABLE [dbo].[Applications] ADD  DEFAULT (getdate()) FOR [dateApplied]
GO
ALTER TABLE [dbo].[Applications] ADD  DEFAULT ('Pending') FOR [status]
GO
ALTER TABLE [dbo].[Bookmarks] ADD  DEFAULT (getdate()) FOR [dateBookmarked]
GO
ALTER TABLE [dbo].[JobPosts] ADD  DEFAULT (getdate()) FOR [dateCreated]
GO
ALTER TABLE [dbo].[Notifications] ADD  DEFAULT ((0)) FOR [readFlag]
GO
ALTER TABLE [dbo].[UserAccounts] ADD  DEFAULT ((1)) FOR [accountFlag]
GO
ALTER TABLE [dbo].[Applications]  WITH CHECK ADD  CONSTRAINT [FK_jobPostID@Applications] FOREIGN KEY([jobPostID])
REFERENCES [dbo].[JobPosts] ([jobPostID])
GO
ALTER TABLE [dbo].[Applications] CHECK CONSTRAINT [FK_jobPostID@Applications]
GO
ALTER TABLE [dbo].[Applications]  WITH CHECK ADD  CONSTRAINT [FK_jobseekerID@Applications] FOREIGN KEY([jobseekerID])
REFERENCES [dbo].[JobSeekers] ([jobseekerID])
GO
ALTER TABLE [dbo].[Applications] CHECK CONSTRAINT [FK_jobseekerID@Applications]
GO
ALTER TABLE [dbo].[Bookmarks]  WITH CHECK ADD  CONSTRAINT [FK_jobPostID@Bookmarks] FOREIGN KEY([jobPostID])
REFERENCES [dbo].[JobPosts] ([jobPostID])
GO
ALTER TABLE [dbo].[Bookmarks] CHECK CONSTRAINT [FK_jobPostID@Bookmarks]
GO
ALTER TABLE [dbo].[Bookmarks]  WITH CHECK ADD  CONSTRAINT [FK_jobseekerID@Bookmarks] FOREIGN KEY([jobseekerID])
REFERENCES [dbo].[JobSeekers] ([jobseekerID])
GO
ALTER TABLE [dbo].[Bookmarks] CHECK CONSTRAINT [FK_jobseekerID@Bookmarks]
GO
ALTER TABLE [dbo].[Employers]  WITH CHECK ADD  CONSTRAINT [FK_email@Employers] FOREIGN KEY([email])
REFERENCES [dbo].[UserAccounts] ([email])
GO
ALTER TABLE [dbo].[Employers] CHECK CONSTRAINT [FK_email@Employers]
GO
ALTER TABLE [dbo].[JobPosts]  WITH CHECK ADD  CONSTRAINT [FK_employerID@JobPosts] FOREIGN KEY([employerID])
REFERENCES [dbo].[Employers] ([employerID])
GO
ALTER TABLE [dbo].[JobPosts] CHECK CONSTRAINT [FK_employerID@JobPosts]
GO
ALTER TABLE [dbo].[JobSeekers]  WITH CHECK ADD  CONSTRAINT [FK_email@JobSeekers] FOREIGN KEY([email])
REFERENCES [dbo].[UserAccounts] ([email])
GO
ALTER TABLE [dbo].[JobSeekers] CHECK CONSTRAINT [FK_email@JobSeekers]
GO
ALTER TABLE [dbo].[Notifications]  WITH CHECK ADD  CONSTRAINT [FK_receiverID@Notifications] FOREIGN KEY([receiverID])
REFERENCES [dbo].[UserAccounts] ([userID])
GO
ALTER TABLE [dbo].[Notifications] CHECK CONSTRAINT [FK_receiverID@Notifications]
GO
ALTER TABLE [dbo].[Notifications]  WITH CHECK ADD  CONSTRAINT [FK_senderID@Notifications] FOREIGN KEY([senderID])
REFERENCES [dbo].[UserAccounts] ([userID])
GO
ALTER TABLE [dbo].[Notifications] CHECK CONSTRAINT [FK_senderID@Notifications]
GO
ALTER TABLE [dbo].[Applications]  WITH CHECK ADD  CONSTRAINT [CK_status@Applications] CHECK  (([status]='Rejected' OR [status]='Call Back' OR [status]='Hired' OR [status]='Pending'))
GO
ALTER TABLE [dbo].[Applications] CHECK CONSTRAINT [CK_status@Applications]
GO
ALTER TABLE [dbo].[JobPosts]  WITH CHECK ADD  CONSTRAINT [CK_jobType@JobPosts] CHECK  (([jobType]='Temporary' OR [jobType]='Internship/OJT' OR [jobType]='Part Time' OR [jobType]='Full Time'))
GO
ALTER TABLE [dbo].[JobPosts] CHECK CONSTRAINT [CK_jobType@JobPosts]
GO
ALTER TABLE [dbo].[JobPosts]  WITH CHECK ADD  CONSTRAINT [CK_maxSalary@JobPosts] CHECK  (([maxSalary]>(0)))
GO
ALTER TABLE [dbo].[JobPosts] CHECK CONSTRAINT [CK_maxSalary@JobPosts]
GO
ALTER TABLE [dbo].[JobPosts]  WITH CHECK ADD  CONSTRAINT [CK_minSalary@JobPosts] CHECK  (([minSalary]>(0)))
GO
ALTER TABLE [dbo].[JobPosts] CHECK CONSTRAINT [CK_minSalary@JobPosts]
GO
ALTER TABLE [dbo].[JobSeekers]  WITH CHECK ADD  CONSTRAINT [CK_gender@JobSeekers] CHECK  (([gender]='Prefer not to say' OR [gender]='LGBTQA++' OR [gender]='Female' OR [gender]='Male'))
GO
ALTER TABLE [dbo].[JobSeekers] CHECK CONSTRAINT [CK_gender@JobSeekers]
GO
ALTER TABLE [dbo].[UserAccounts]  WITH CHECK ADD  CONSTRAINT [CK_userType@UserAccounts] CHECK  (([userType]='Employer' OR [userType]='Job Seeker'))
GO
ALTER TABLE [dbo].[UserAccounts] CHECK CONSTRAINT [CK_userType@UserAccounts]
GO
/****** Object:  StoredProcedure [dbo].[AUTH_AddUserAccount]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- Add Job Seeker Account Procedure
CREATE PROCEDURE [dbo].[AUTH_AddUserAccount]
	@email				VARCHAR(450),
	@password			VARCHAR(MAX),
	@userType			VARCHAR(MAX)
AS
	INSERT INTO [UserAccounts] 
		( [email]
		, [password]
		, [userType] )
	VALUES 
		( @email
		, @password
		, @userType )
;
GO
/****** Object:  StoredProcedure [dbo].[AUTH_FindEmployer]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[AUTH_FindEmployer]
	@email	VARCHAR(450)
AS
	SELECT * FROM [Employers]
	WHERE [email] = @email
;
GO
/****** Object:  StoredProcedure [dbo].[AUTH_FindJobseeker]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[AUTH_FindJobseeker]
	@email	VARCHAR(450)
AS
	SELECT
		  [jobseekerID]
		, [firstName]
		, [middleName]
		, [lastName]
		, [birthDate]
		, DATEDIFF(year, [birthDate], getdate()) as [age]
		, [gender]
		, [street]
		, [brgyDistrict]
		, [cityMunicipality]
		, [contactNumber]
		, [email]
		, [description]
		, [skills]
		, [experiences]
		, [education]
		, [profilePic]
	FROM [JobSeekers]
	WHERE [email] = @email
;
GO
/****** Object:  StoredProcedure [dbo].[AUTH_FindUserAccount]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[AUTH_FindUserAccount]
	@email		VARCHAR(450)
AS
	SELECT 
		  [email]
		, [password]
		, [userType]
		, CAST([accountFlag] AS INT) AS [status]
	FROM [UserAccounts]
	WHERE [email] = @email
GO
/****** Object:  StoredProcedure [dbo].[AUTH_RegisterEmployer]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[AUTH_RegisterEmployer]
	@companyName		VARCHAR(MAX),
	@street				VARCHAR(MAX),
	@brgyDistrict		VARCHAR(MAX),
	@cityMunicipality	VARCHAR(MAX),
	@contactNumber		VARCHAR(MAX),
	@email				VARCHAR(450),
	@website			VARCHAR(MAX),
	@description		VARCHAR(MAX)
AS
	INSERT INTO [Employers]
		( [companyName]
		, [street]
		, [brgyDistrict]
		, [cityMunicipality]
		, [contactNumber]
		, [email]
		, [website]
		, [description] )
	VALUES
		( @companyName
		, @street
		, @brgyDistrict
		, @cityMunicipality
		, @contactNumber
		, @email
		, @website
		, @description )
;
GO
/****** Object:  StoredProcedure [dbo].[AUTH_RegisterJobseeker]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[AUTH_RegisterJobseeker]
	@firstName			VARCHAR(MAX),
	@middleName			VARCHAR(MAX),
	@lastName			VARCHAR(MAX),
	@birthDate			VARCHAR(MAX),
	@gender				VARCHAR(MAX),
	@street				VARCHAR(MAX),
	@brgyDistrict		VARCHAR(MAX),
	@cityMunicipality	VARCHAR(MAX),
	@contactNumber		VARCHAR(MAX),
	@email				VARCHAR(450),
	@description		VARCHAR(MAX),
	@skills				VARCHAR(MAX),
	@experiences		VARCHAR(MAX),
	@education			VARCHAR(MAX)
AS
	INSERT INTO [JobSeekers] 
		( [firstName]
		, [middleName]
		, [lastName]
		, [birthDate]
		, [gender]
		, [street]
		, [brgyDistrict]
		, [cityMunicipality]
		, [contactNumber]
		, [email]
		, [description]
		, [skills]
		, [experiences]
		, [education] )
	VALUES 
		( @firstName
		, @middleName
		, @lastName
		, @birthDate
		, @gender
		, @street
		, @brgyDistrict
		, @cityMunicipality
		, @contactNumber
		, @email
		, @description
		, @skills
		, @experiences
		, @education )
;
GO
/****** Object:  StoredProcedure [dbo].[AUTH_SetAccountFlag]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[AUTH_SetAccountFlag]
	@email VARCHAR(450),
	@flag  INT
AS
	UPDATE [UserAccounts]
	SET [accountFlag] = @flag
	WHERE [email] = @email
;
GO
/****** Object:  StoredProcedure [dbo].[EMPL_DeletePost]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[EMPL_DeletePost]
	@jobPostID	INT,
	@employerID INT
AS
	DELETE FROM [JobPosts] 
	WHERE [jobPostID] = @jobPostID AND [employerID] = @employerID
;
GO
/****** Object:  StoredProcedure [dbo].[EMPL_GetAllPosts]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[EMPL_GetAllPosts] 
	@employerID INT
AS
	SELECT [jobPostID]
	FROM [JobPosts]
	WHERE [employerID] = @employerID
;
GO
/****** Object:  StoredProcedure [dbo].[EMPL_GetPosts]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[EMPL_GetPosts] 
	@offsetRows  INT,
	@fetchedRows INT,
	@employerID  INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [status]
		, COUNT([Applications].[applicationID]) AS [numOfApplicants]
	FROM [JobPosts]
	FULL OUTER JOIN [Applications]
	ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
	-- AND [Applications].[status]  != 'Rejected'
	WHERE [employerID] = @employerID
	GROUP BY
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[jobPostFlag]
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
;
GO
/****** Object:  StoredProcedure [dbo].[EMPL_NumOfPosts]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[EMPL_NumOfPosts]
	@employerID INT
AS
	SELECT COUNT([jobPostID]) AS [postsNum]
	FROM JobPosts 
	WHERE employerID = @employerID
;
GO
/****** Object:  StoredProcedure [dbo].[EMPL_PostNewJob]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[EMPL_PostNewJob]
	@employerID			INT,
	@jobTitle			VARCHAR(MAX),
	@jobType			VARCHAR(MAX),
	@industryType		VARCHAR(MAX),
	@description		VARCHAR(MAX),
	@responsibilities	VARCHAR(MAX),
	@skills				VARCHAR(MAX),
	@experiences		VARCHAR(MAX),
	@education			VARCHAR(MAX),
	@minSalary			MONEY,
	@maxSalary			MONEY,
	@jobPostFlag		BINARY
AS
	INSERT INTO [JobPosts]
		( [employerID]
		, [jobTitle]
		, [jobType]
		, [industryType]
		, [description]
		, [responsibilities]
		, [skills]
		, [experiences]
		, [education]
		, [minSalary]
		, [maxSalary]
		, [jobPostFlag])
	VALUES
		( @employerID
		, @jobTitle			
		, @jobType			
		, @industryType		
		, @description	
		, @responsibilities
		, @skills		
		, @experiences	
		, @education	
		, @minSalary		
		, @maxSalary		
		, @jobPostFlag )
;
GO
/****** Object:  StoredProcedure [dbo].[EMPL_SetApplicantStatus]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[EMPL_SetApplicantStatus]
	@applicationID INT,
	@status		   VARCHAR(MAX)
AS
	UPDATE [Applications]
	SET [status] = @status
	WHERE [applicationID] = @applicationID
;
GO
/****** Object:  StoredProcedure [dbo].[EMPL_SetProfilePic]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[EMPL_SetProfilePic]
	@employerID INT,
	@profilePic	VARCHAR(MAX)
AS
	UPDATE [Employers]
	SET [profilePic] = @profilePic
	WHERE employerID = @employerID
;
GO
/****** Object:  StoredProcedure [dbo].[EMPL_UpdateInfo]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[EMPL_UpdateInfo]
	@employerID			INT,
	@companyName		VARCHAR(MAX),
	@street				VARCHAR(MAX),
	@brgyDistrict		VARCHAR(MAX),
	@cityMunicipality	VARCHAR(MAX),
	@contactNumber		VARCHAR(MAX),
	@website			VARCHAR(MAX),
	@description		VARCHAR(MAX)
AS
	UPDATE [Employers]
	SET
		  [companyName] 	 = @companyName
		, [street] 			 = @street
		, [brgyDistrict] 	 = @brgyDistrict
		, [cityMunicipality] = @cityMunicipality
		, [contactNumber] 	 = @contactNumber
		, [website] 		 = @website
		, [description] 	 = @description
	WHERE [employerID] = @employerID
;
GO
/****** Object:  StoredProcedure [dbo].[EMPL_UpdatePost]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[EMPL_UpdatePost]
	@jobPostID			INT,
	@jobTitle			VARCHAR(MAX),
	@jobType			VARCHAR(MAX),
	@industryType		VARCHAR(MAX),
	@description		VARCHAR(MAX),
	@responsibilities	VARCHAR(MAX),
	@skills				VARCHAR(MAX),
	@experiences		VARCHAR(MAX),
	@education			VARCHAR(MAX),
	@minSalary			MONEY,
	@maxSalary			MONEY,
	@jobPostFlag		BINARY
AS
	UPDATE [JobPosts]
	SET
		  [jobTitle] 			= @jobTitle
		, [jobType] 			= @jobType
		, [industryType] 		= @industryType
		, [description] 		= @description
		, [responsibilities] 	= @responsibilities
		, [skills] 				= @skills
		, [experiences] 		= @experiences
		, [education] 			= @education
		, [minSalary] 			= @minSalary
		, [maxSalary] 			= @maxSalary
		, [dateModified] 		= getdate()
		, [jobPostFlag] 		= @jobPostFlag
	WHERE [jobPostID]			= @jobPostID
;
GO
/****** Object:  StoredProcedure [dbo].[EMPL_ViewAllApplicants]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[EMPL_ViewAllApplicants]
	@jobPostID   INT
AS
	SELECT [Applications].[applicationID]
	FROM [Applications]
	INNER JOIN [JobSeekers]
		ON [JobSeekers].[jobseekerID] = [Applications].[jobseekerID]
		AND [Applications].[jobPostID] = @jobPostID
;
GO
/****** Object:  StoredProcedure [dbo].[EMPL_ViewApplicantProfile]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[EMPL_ViewApplicantProfile]
	@jobseekerID INT,
	@jobPostID   INT
AS
	SELECT
		  [JobSeekers].[jobseekerID]
		, [JobSeekers].[profilePic]
		, [JobSeekers].[firstName]
		, [JobSeekers].[middleName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[birthDate]
		, DATEDIFF(year, [JobSeekers].[birthDate], getdate()) as [age]
		, [JobSeekers].[gender]
		, [JobSeekers].[street]
		, [JobSeekers].[brgyDistrict]
		, [JobSeekers].[cityMunicipality]
		, [JobSeekers].[contactNumber]
		, [JobSeekers].[email]
		, [JobSeekers].[description]
		, [JobSeekers].[skills]
		, [JobSeekers].[experiences]
		, [JobSeekers].[education]
		, [Applications].[applicationID]
		, [Applications].[jobPostID]
		, [Applications].[status]
		, [JobPosts].[jobTitle]
	FROM [Applications]
	INNER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
	INNER JOIN [JobPosts]
		ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
		AND [JobSeekers].[jobseekerID] = @jobseekerID
		AND [Applications].[jobPostID] = @jobPostID
;
GO
/****** Object:  StoredProcedure [dbo].[EMPL_ViewApplicants]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[EMPL_ViewApplicants]
	@offsetRows  INT,
	@fetchedRows INT,
	@jobPostID   INT
AS
	SELECT
		  [JobSeekers].[jobseekerID]
		, [JobSeekers].[profilePic]
		, [JobSeekers].[firstName]
		, [JobSeekers].[middleName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[gender]
		, [JobSeekers].[brgyDistrict]
		, [JobSeekers].[cityMunicipality]
		, [JobSeekers].[email]
		, [Applications].[applicationID]
		, [Applications].[jobPostID]
		, [Applications].[status]
		, [Applications].[dateApplied]
	FROM [Applications]
	INNER JOIN [JobSeekers]
		ON [JobSeekers].[jobseekerID] = [Applications].[jobseekerID]
		AND [Applications].[jobPostID] = @jobPostID
	ORDER BY [Applications].[dateApplied] ASC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
;
GO
/****** Object:  StoredProcedure [dbo].[EMPL_ViewPost]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[EMPL_ViewPost]
	@jobPostID	INT,
	@employerID INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[dateModified]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [status]
		, COUNT([Applications].[applicationID]) AS [numOfApplicants]
	FROM [JobPosts]
	LEFT OUTER JOIN [Applications]
		ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
	WHERE [JobPosts].[jobPostID] = @jobPostID 
		AND [JobPosts].[employerID] = @employerID
	GROUP BY
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[dateModified]
		, [JobPosts].[jobPostFlag]
;
GO
/****** Object:  StoredProcedure [dbo].[JBSK_AddBookmark]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[JBSK_AddBookmark]
	@jobseekerID INT,
	@jobPostID	 INT
AS
	INSERT INTO [Bookmarks]
		( [jobseekerID]
		, [jobPostID] )
	VALUES 
		( @jobseekerID
		, @jobPostID )
;
GO
/****** Object:  StoredProcedure [dbo].[JBSK_AllAppliedJobs]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[JBSK_AllAppliedJobs]
	@jobseekerID INT
AS
	SELECT [JobPosts].[jobPostID]
	FROM [JobPosts]
	INNER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [Applications].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[bookmarkID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	ORDER BY [Applications].[dateApplied] DESC
;
GO
/****** Object:  StoredProcedure [dbo].[JBSK_AppliedJobs]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[JBSK_AppliedJobs]
	@offsetRows	 INT,
	@fetchedRows INT,
	@jobseekerID INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityMunicipality] AS [location]
		, [Applications].[applicationID]
		, [Applications].[dateApplied]
		, [Applications].[status]
		, [Bookmarks].[bookmarkID]
	FROM [JobPosts]
	INNER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [Applications].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	ORDER BY [Applications].[dateApplied] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
;
GO
/****** Object:  StoredProcedure [dbo].[JBSK_CancelApplication]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[JBSK_CancelApplication]
	@jobPostID	 INT,
	@jobseekerID INT
AS
	DELETE FROM [Applications]
	WHERE [jobPostID] = @jobPostID AND @jobseekerID = @jobseekerID
;
GO
/****** Object:  StoredProcedure [dbo].[JBSK_GetAllBookmarks]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[JBSK_GetAllBookmarks]
	@jobseekerID INT
AS
	SELECT [Bookmarks].[bookmarkID]
	FROM [Bookmarks]
	INNER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
;
GO
/****** Object:  StoredProcedure [dbo].[JBSK_GetBookmarks]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[JBSK_GetBookmarks]
	@jobseekerID INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [Bookmarks].[bookmarkID]
		, [Bookmarks].[dateBookmarked]
		, [Bookmarks].[jobseekerID]
		, [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityMunicipality] AS [location]
		, [Applications].[status]
	FROM [Bookmarks]
	INNER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	ORDER BY [Bookmarks].[dateBookmarked] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROW ONLY
;
GO
/****** Object:  StoredProcedure [dbo].[JBSK_NumOfAppliedJobs]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- Number of Applied Jobs Procedure
CREATE PROCEDURE [dbo].[JBSK_NumOfAppliedJobs]
	@jobseekerID INT
AS
	SELECT COUNT(JobPostID) AS [appliedJobsNum]
	FROM Applications
	WHERE jobseekerID = @jobseekerID
;

GO
/****** Object:  StoredProcedure [dbo].[JBSK_NumOfBookmarks]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[JBSK_NumOfBookmarks]
	@jobseekerID INT
AS
	SELECT COUNT([bookmarkID]) AS [bookmarksNum]
	FROM [Bookmarks]
	WHERE [jobseekerID] = @jobseekerID
;
GO
/****** Object:  StoredProcedure [dbo].[JBSK_RemoveBookmark]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[JBSK_RemoveBookmark]
	@bookmarkID INT
AS
	DELETE FROM [Bookmarks] WHERE [bookmarkID] = @bookmarkID
;
GO
/****** Object:  StoredProcedure [dbo].[JBSK_SetProfilePic]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[JBSK_SetProfilePic]
	@jobseekerID INT,
	@profilePic	 VARCHAR(MAX)
AS
	UPDATE [JobSeekers]
	SET [profilePic] = @profilePic
	WHERE [jobseekerID] = @jobseekerID
;
GO
/****** Object:  StoredProcedure [dbo].[JBSK_SubmitApplication]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[JBSK_SubmitApplication]
	@jobPostID	 INT,
	@jobseekerID INT
AS
	INSERT INTO [Applications]
		( [jobPostID]
		, [jobseekerID] )
	VALUES (
		@jobPostID,
		@jobseekerID
	)
;
GO
/****** Object:  StoredProcedure [dbo].[JBSK_UpdateInfo]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[JBSK_UpdateInfo]
	@jobseekerID		INT,
	@firstName			VARCHAR(MAX),
	@middleName			VARCHAR(MAX),
	@lastName			VARCHAR(MAX),
	@birthDate			VARCHAR(MAX),
	@gender				VARCHAR(MAX),
	@street				VARCHAR(MAX),
	@brgyDistrict		VARCHAR(MAX),
	@cityMunicipality	VARCHAR(MAX),
	@contactNumber		VARCHAR(MAX),
	@description		VARCHAR(MAX),
	@skills				VARCHAR(MAX),
	@experiences		VARCHAR(MAX),
	@education			VARCHAR(MAX)
AS
	UPDATE [JobSeekers]
	SET
		  [firstName] 		 = @firstName
		, [middleName] 		 = @middleName
		, [lastName] 		 = @lastName
		, [birthDate] 		 = @birthDate
		, [gender] 			 = @gender
		, [street] 			 = @street
		, [brgyDistrict] 	 = @brgyDistrict
		, [cityMunicipality] = @cityMunicipality
		, [contactNumber] 	 = @contactNumber
		, [description]		 = @description
		, [skills] 			 = @skills
		, [experiences] 	 = @experiences
		, [education] 		 = @education
	WHERE [jobseekerID] = @jobseekerID
;
GO
/****** Object:  StoredProcedure [dbo].[JBSK_ViewAllRecentPosts]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[JBSK_ViewAllRecentPosts]
	@jobseekerID INT
AS
	SELECT
		  [JobPosts].[jobPostID]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
;

GO
/****** Object:  StoredProcedure [dbo].[JBSK_ViewAvailableJobs]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[JBSK_ViewAvailableJobs]
	@jobseekerID INT,
	@employerID  INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityMunicipality] AS [location]
		, [Bookmarks].[bookmarkID]
		, [Applications].[dateApplied]
		, [Applications].[status]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [JobPosts].[employerID] = @employerID
		AND [jobPostFlag] = 1
	LEFT JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] =  @jobseekerID
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
;
GO
/****** Object:  StoredProcedure [dbo].[JBSK_ViewJobDetails]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[JBSK_ViewJobDetails]
	@jobPostID	 INT,
	@jobseekerID INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[dateModified]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [status]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityMunicipality] AS [location]
		, [Employers].[contactNumber]
		, [Employers].[email]
		, [Employers].[website]
		, [Applications].[dateApplied]
		, [Applications].[status]
		, [Bookmarks].[bookmarkID]
	FROM [JobPosts]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [JobPosts].[jobPostID] = @jobPostID AND [JobPosts].[jobPostFlag] = 1
	LEFT JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	LEFT JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
;
GO
/****** Object:  StoredProcedure [dbo].[JBSK_ViewRecentPosts]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[JBSK_ViewRecentPosts]
	@jobseekerID INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[jobPostFlag]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityMunicipality] AS [location]
		, [Bookmarks].[bookmarkID]
		, [Applications].[status]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
;
GO
/****** Object:  StoredProcedure [dbo].[VIEW_AllAvailableJobs]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[VIEW_AllAvailableJobs]
	@employerID  INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityMunicipality] AS [location]
	FROM [JobPosts]
	INNER JOIN [Employers] 
	ON [JobPosts].[employerID] = [Employers].[employerID]
	AND [JobPosts].[employerID] = @employerID
	AND [jobPostFlag] = 1
;
GO
/****** Object:  StoredProcedure [dbo].[VIEW_AllRecentPosts]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[VIEW_AllRecentPosts]
AS
	SELECT
		  [JobPosts].[jobPostID]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
;
GO
/****** Object:  StoredProcedure [dbo].[VIEW_AvailableJobs]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[VIEW_AvailableJobs]
	@employerID  INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityMunicipality] AS [location]
	FROM [JobPosts]
	INNER JOIN [Employers] 
	ON [JobPosts].[employerID] = [Employers].[employerID]
	AND [JobPosts].[employerID] = @employerID
	AND [jobPostFlag] = 1
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
;
GO
/****** Object:  StoredProcedure [dbo].[VIEW_CompanyDetails]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[VIEW_CompanyDetails]
	@employerID INT
AS
	SELECT
		  [employerID]
		, [profilePic]
		, [companyName]
		, [description]
		, [street] + ', ' + [brgyDistrict] + ', ' + [cityMunicipality] AS [location]
		, [contactNumber]
		, [email]
		, [website]
	FROM [Employers]
	WHERE [employerID] = @employerID
;
GO
/****** Object:  StoredProcedure [dbo].[VIEW_JobDetails]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[VIEW_JobDetails]
	@jobPostID	INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[dateModified]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [status]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityMunicipality] AS [location]
		, [Employers].[contactNumber]
		, [Employers].[email]
		, [Employers].[website]
	FROM [JobPosts]
	INNER JOIN [Employers]
	ON [JobPosts].[employerID] = [Employers].[employerID]
	AND [JobPosts].[jobPostID] = @jobPostID AND [JobPosts].[jobPostFlag] = 1
;
GO
/****** Object:  StoredProcedure [dbo].[VIEW_RecentPosts]    Script Date: 27/12/2020 9:08:16 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[VIEW_RecentPosts]
	@offsetRows		INT,
	@fetchedRows	INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[industryType]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityMunicipality] AS [location]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
;
GO
USE [master]
GO
ALTER DATABASE [ABN_DB] SET  READ_WRITE 
GO
